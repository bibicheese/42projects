/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   misc.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: adequidt <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/11 17:59:50 by adequidt          #+#    #+#             */
/*   Updated: 2019/02/20 16:46:12 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "fillit.h"

/*
**	Calcul du carre potentiel le plus petit
**	(pour gagner du temps sur le backtracking)
*/

int		min_v_line(char *str)
{
	int		i;
	int		j;
	int		sqrt;

	i = (ft_strlen(str) / 4);
	j = 0;
	if (i == 4)
		return (count_one(str));
	if (i == 8)
		return (3);
	while (j < i)
	{
		sqrt = j * j;
		if (sqrt == i)
			return (j);
		if (sqrt > i)
			return (j - 1);
		j++;
	}
	return (-1);
}

int		count_one(char *str)
{
	int		i;
	int		j[2];

	i = 0;
	while (str[i] != '#')
		i++;
	j[0] = count_line(str, i);
	j[1] = count_col(str, i);
	if (j[0] == 2 && j[1] == 2)
		return (check_except(str, i));
	if (j[0] >= j[1])
		return (j[0]);
	return (j[1]);
}

int		count_line(char *str, int i)
{
	int			line;
	static int	j;

	line = 1;
	while (str[i += 1] == '#')
		line++;
	if (line == 1)
	{
		j++;
		while (str[i] != '#')
			i++;
		if (j > 2)
			return (line);
		return (count_line(str, i));
	}
	return (line);
}

int		count_col(char *str, int i)
{
	int			col;
	int			j;
	static int	k;

	col = 1;
	j = i;
	while (i + 4 < 16 && str[i += 4] == '#')
		col++;
	if (col == 1)
	{
		k++;
		j++;
		while (str[j] != '#')
			j++;
		if (k > 2)
			return (col);
		return (count_col(str, j));
	}
	return (col);
}

int		check_except(char *str, int i)
{
	while (str[i])
	{
		if (str[i] == '#')
			if (ft_checkside(str, i, 0) == 1)
				return (3);
		i++;
	}
	return (2);
}
