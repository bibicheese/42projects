/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   create_ttrm.c                                      :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: adequidt <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/25 16:41:14 by adequidt          #+#    #+#             */
/*   Updated: 2019/02/20 16:58:41 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "fillit.h"

char	*str_trim(char *str, int v_line)
{
	int		i;
	int		j;

	i = 0;
	j = 0;
	while (j < 4)
	{
		while (i < v_line)
		{
			if (str[i] != '.')
				return (str);
			i++;
		}
		str += 4;
		i = 0;
		j++;
	}
	return (str);
}

char	*str_move(char *str, int v_line)
{
	int		i;
	int		j;
	int		tab[4];

	i = -1;
	j = -1;
	while (str[++i])
	{
		if (str[i] != '.')
			tab[++j] = i;
	}
	if (tab[0] / v_line == (tab[0] - 1) / v_line &&
		tab[1] / v_line == (tab[1] - 1) / v_line &&
		tab[2] / v_line == (tab[2] - 1) / v_line &&
		tab[3] / v_line == (tab[3] - 1) / v_line && tab[0] > 0)
		return (str_move(str + 1, v_line));
	return (str);
}

t_trm	create(char *str, int number)
{
	t_trm	new_ttrm;
	int		i;
	int		j;
	int		tab[4];

	i = 0;
	j = 0;
	while (str[i])
	{
		if (str[i] != '.')
		{
			tab[j] = i;
			j++;
		}
		i++;
	}
	new_ttrm.x1 = tab[0];
	new_ttrm.x2 = tab[1];
	new_ttrm.x3 = tab[2];
	new_ttrm.x4 = tab[3];
	new_ttrm.letter = number + 'A';
	new_ttrm.j = -1;
	return (new_ttrm);
}

t_trm	*ttrm_edit(char *str, int v_line, int i)
{
	char		*tmp[2];
	t_trm		*tet;

	if (!(tet = malloc(sizeof(t_trm) * 27)))
		return (0);
	while (*str)
	{
		tmp[0] = ft_memalloc(16);
		tmp[0] = ft_strncat(tmp[0], str, 16);
		str += 16;
		tmp[1] = str_move(tmp[0], 4);
		tmp[1] = str_trim(tmp[1], 4);
		tet[i] = create(tmp[1], i);
		ft_memdel((void**)&tmp[0]);
		i++;
	}
	tet[0].v_line = v_line;
	if (v_line < 4)
		if (!(downgrade_ttrm(tet, tet[0].v_line)))
			(tet[0]).v_line = 4;
	if (v_line > 4)
		first_upgrade(tet, v_line);
	return (tet);
}
