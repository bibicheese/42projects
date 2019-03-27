/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   place_ttrm.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: adequidt <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/11 14:57:49 by adequidt          #+#    #+#             */
/*   Updated: 2019/02/20 18:19:57 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "fillit.h"

char	*create_str(int v_line)
{
	int		i;
	char	*str;

	i = 0;
	str = ft_strnew((size_t)(v_line * v_line));
	while (i < (v_line * v_line))
	{
		str[i] = '.';
		i++;
	}
	return (str);
}

void	print_str(char *str, int v_line)
{
	int		i;
	int		j;

	i = 0;
	j = 0;
	while (str[i])
	{
		while (j < v_line)
		{
			ft_putchar(str[i]);
			i++;
			j++;
		}
		ft_putchar('\n');
		j = 0;
	}
	ft_memdel((void **)&str);
	exit(1);
}

/*
**	Fusion entre str et les tetriminos, avec un dernier check pour s'assurer que
**	le x4 ne sort pas de la string.
*/

int		strmerge(char *str, t_trm tet, int v_line)
{
	if (tet.j + tet.x4 >= ft_strlen(str))
		return (0);
	if (str[tet.j + tet.x1] == '.' &&
			str[tet.j + tet.x2] == '.' &&
			str[tet.j + tet.x3] == '.' &&
			str[tet.j + tet.x4] == '.')
	{
		str[tet.j + tet.x1] = tet.letter;
		str[tet.j + tet.x2] = tet.letter;
		str[tet.j + tet.x3] = tet.letter;
		str[tet.j + tet.x4] = tet.letter;
		return (1);
	}
	return (0);
}
