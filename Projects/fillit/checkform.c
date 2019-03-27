/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_checkform.c                                     :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/28 15:49:24 by jmondino          #+#    #+#             */
/*   Updated: 2019/02/20 18:20:34 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "fillit.h"

void	ft_checkform(char *stock)
{
	int		i;
	int		j;

	i = 0;
	j = 0;
	while (stock[i])
	{
		if (stock[i] == '#')
		{
			if (ft_checkside(stock, i, j) == 0)
				ft_error(2);
			if (ft_checkside(stock, i, j) >= 2)
				j++;
		}
		i++;
	}
	if (j < 1)
		ft_error(2);
}

int		ft_checkside(char *tetri, int i, int count)
{
	count = 0;
	if (i + 1 <= 16 && (i + 1) % 4 != 0)
	{
		if (tetri[i + 1] == '#')
			count++;
	}
	if (i + 4 <= 16)
	{
		if (tetri[i + 4] == '#')
			count++;
	}
	if (i - 1 >= 0 && i % 4 != 0)
	{
		if (tetri[i - 1] == '#')
			count++;
	}
	if (i - 4 >= 0)
	{
		if (tetri[i - 4] == '#')
			count++;
	}
	return (count);
}

char	*ft_stockalltetris(char *line)
{
	static char		*tetris;
	static int		i;
	char			*tmp;

	tmp = ft_strjoin(tetris, line);
	ft_memdel((void **)&tetris);
	tetris = tmp;
	return (tetris);
}

void	ft_error(int ac)
{
	if (ac != 2)
		ft_putstr("usage: ./fillit input_file\n");
	else
		ft_putstr("error\n");
	exit(1);
}

void	ft_checklastline(char *line, int ac)
{
	if (ac % 4 != 0)
		ft_error(2);
	if (line[0] == '\0')
		ft_error(2);
}
